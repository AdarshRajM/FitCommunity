import React, { useRef, useMemo } from 'react';
import { Canvas, useFrame } from '@react-three/fiber';
import { Points, PointMaterial } from '@react-three/drei';
import * as random from 'maath/random/dist/maath-random.esm';

function ParticleSphere(props) {
    const ref = useRef();
    const sphere = useMemo(() => random.inSphere(new Float32Array(5000), { radius: 1.5 }), []);

    useFrame((state, delta) => {
        if (ref.current) {
            ref.current.rotation.x -= delta / 10;
            ref.current.rotation.y -= delta / 15;
            
            // Subtle breathing effect
            const scale = 1 + Math.sin(state.clock.elapsedTime * 0.5) * 0.05;
            ref.current.scale.set(scale, scale, scale);
        }
    });

    return (
        <group rotation={[0, 0, Math.PI / 4]}>
            <Points ref={ref} positions={sphere} stride={3} frustumCulled={false} {...props}>
                <PointMaterial
                    transparent
                    color="#4CAF50"
                    size={0.005}
                    sizeAttenuation={true}
                    depthWrite={false}
                    blending={2} // Additive blending
                />
            </Points>
        </group>
    );
}

function ParticleNetwork(props) {
    const ref = useRef();
    const sphere2 = useMemo(() => random.inSphere(new Float32Array(3000), { radius: 2.2 }), []);

    useFrame((state, delta) => {
        if (ref.current) {
            ref.current.rotation.x += delta / 20;
            ref.current.rotation.y += delta / 25;
            
            // Mouse parallax
            ref.current.position.x += (state.mouse.x * 0.2 - ref.current.position.x) * 0.05;
            ref.current.position.y += (state.mouse.y * 0.2 - ref.current.position.y) * 0.05;
        }
    });

    return (
        <group rotation={[0, 0, Math.PI / 4]}>
            <Points ref={ref} positions={sphere2} stride={3} frustumCulled={false} {...props}>
                <PointMaterial
                    transparent
                    color="#2196F3"
                    size={0.003}
                    sizeAttenuation={true}
                    depthWrite={false}
                    blending={2}
                />
            </Points>
        </group>
    );
}

export default function ThreeBackground() {
    return (
        <div className="absolute inset-0 z-0 pointer-events-none">
            <Canvas camera={{ position: [0, 0, 3] }}>
                <ambientLight intensity={0.5} />
                <ParticleSphere />
                <ParticleNetwork />
            </Canvas>
        </div>
    );
}
