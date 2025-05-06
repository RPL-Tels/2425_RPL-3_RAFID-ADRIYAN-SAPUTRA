import * as THREE from 'three';
import { OrbitControls } from 'three/examples/jsm/controls/OrbitControls.js';
import { GLTFLoader } from 'three/examples/jsm/loaders/GLTFLoader.js';
import { FBXLoader } from 'three/examples/jsm/loaders/FBXLoader.js';
import { OBJLoader } from 'three/examples/jsm/loaders/OBJLoader.js';
import { TDSLoader } from 'three/examples/jsm/loaders/TDSLoader.js';

export function init3DViewer(containerId, modelUrl) {
    // 1. SETUP SCENE, CAMERA, AND RENDERER
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ antialias: true });

    const container = document.getElementById(containerId);
    if (container) {
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        container.appendChild(renderer.domElement);
    } else {
        console.error("Div container not found");
    }

    scene.background = new THREE.Color(0xeeeeee);

    // Add lights
    const hemiLight = new THREE.HemisphereLight(0xffffff, 0x444444, 1.2);
    hemiLight.position.set(0, 20, 0);
    scene.add(hemiLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff, 20);
    directionalLight.position.set(10, 10, 10);
    scene.add(directionalLight);

    // Membuat platform
        const platformGeometry = new THREE.PlaneGeometry(500, 500); // Ukuran platform
        const platformMaterial = new THREE.MeshStandardMaterial({ color: 0x808080 }); // Warna platform
        const platform = new THREE.Mesh(platformGeometry, platformMaterial);

        // Rotasi platform agar horizontal
        platform.rotation.x = -Math.PI / 2; // Rotasi 90 derajat
        platform.position.y = -1; // Atur posisi platform sedikit di bawah model
        // Tambahkan platform ke scene
        scene.add(platform);

        const gridHelper = new THREE.GridHelper(500, 50); // Ukuran grid dan jumlah garis
        scene.add(gridHelper);
        
    // 2. LOAD MODEL FUNCTION
    function loadModel(filePath) {
        const loader = getLoaderForFile(filePath);

        if (!loader) {
            console.error('Loader tidak tersedia untuk format file ini.');
            return;
        }

        loader.load(
            filePath,
            (object) => {
                if (object.scene) object = object.scene; // Handle GLTF/GLB

                object.traverse((child) => {
                    if (child.isMesh) {
                        // Periksa apakah memiliki material
                        if (!child.material) {
                            console.warn(`Mesh ${child.name} tidak memiliki material, menggunakan material default.`);
                            child.material = new THREE.MeshStandardMaterial({
                                color: 0xaaaaaa, // Warna default abu-abu
                                roughness: 0.5,
                                metalness: 0.2,
                            });
                        } else {
                            // Periksa apakah material memiliki peta warna (texture map)
                            if (child.material.map) {
                                child.material.map.encoding = THREE.sRGBEncoding; // Pastikan encoding benar
                            } else if (child.material.color) {
                                console.log(`Mesh ${child.name} memiliki warna:`, child.material.color);
                                // Tidak perlu tindakan tambahan, material sudah memiliki warna bawaan
                            } else {
                                console.warn(`Material pada mesh ${child.name} tidak memiliki warna atau tekstur.`);
                            }
                        }
                    }
                }); 

                scene.add(object);
                adjustCameraToObject(object);
                animate();
            },
            undefined,
            (error) => {
                console.error('Error saat memuat model:', error);
            }
        );
    }

    // 3. ORBIT CONTROLS
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;

    // Enable right-click panning
    controls.mouseButtons = {
        RIGHT: THREE.MOUSE.PAN,
        LEFT: THREE.MOUSE.ROTATE,
        MIDDLE: THREE.MOUSE.DOLLY,
    };

    // 4. AUTO CAMERA ADJUSTMENT
    function adjustCameraToObject(object) {
        object.updateWorldMatrix(true, true);

        const box = new THREE.Box3().setFromObject(object);
        const size = new THREE.Vector3();
        const center = new THREE.Vector3();

        box.getSize(size);
        box.getCenter(center);

        const maxDim = Math.max(size.x, size.y, size.z);
        const fov = camera.fov * (Math.PI / 180);
        const distance = (maxDim / 2) / Math.tan(fov / 2);
        const padding = 2;

        camera.position.set(center.x, center.y, center.z + distance * padding);
        controls.target.copy(center);
        controls.update();
    }

    // 5. HANDLE WINDOW RESIZE
    window.addEventListener('resize', () => {
        if (container) {
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.clientWidth, container.clientHeight);
        }
    });
    

    // 6. ANIMATE THE SCENE
    function animate() {
        requestAnimationFrame(animate);
        controls.update();
        renderer.render(scene, camera);
    }

    animate();

    // 7. LOADER BASED ON FILE EXTENSION
    function getLoaderForFile(url) {
        const extension = url.split('.').pop().toLowerCase();

        switch (extension) {
            case 'gltf':
            case 'glb':
            case 'json' :
                return new GLTFLoader();
            case 'fbx':
            case 'bin' :
                return new FBXLoader();
            case 'obj':
            case 'txt' :
                return new OBJLoader();
            case '3ds':
                return new TDSLoader();
            default:
                console.error('Format file tidak didukung:', extension);
                return null;
        }
    }

    // 8. LOAD EXAMPLE FILE
    loadModel(modelUrl); // Ganti dengan path file 3D Anda
}