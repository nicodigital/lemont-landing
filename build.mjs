import esbuild from 'esbuild';

// Configuración básica de esbuild
const buildOptions = {
  entryPoints: ['js/global.js'],  // Cambia la ruta según tu archivo
  bundle: true,
  outfile: 'public/js/scripts.js',  // Cambia la ruta según tu estructura de carpetas
  minify: true,  // Opcional: minimiza el archivo de salida
  sourcemap: true,  // Opcional: genera un sourcemap para facilitar la depuración
};

// Función para construir y observar cambios
async function buildAndWatch() {
  const ctx = await esbuild.context(buildOptions);

  await ctx.watch();  // Activar el modo de observación

  console.log("Watching for changes...");
}

// Iniciar el proceso
buildAndWatch().catch(() => process.exit(1));