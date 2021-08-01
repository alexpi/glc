import resolve from 'rollup-plugin-node-resolve';
import commonjs from 'rollup-plugin-commonjs';
import { terser } from 'rollup-plugin-terser';

const minify = () => (process.env.BUILD === 'production') ? terser() : '';

export default {
	input: 'src/js/app.js',
	output: {
		file: 'assets/app.js',
		format: 'iife'
	},
	plugins: [
		resolve(),
		commonjs({
			include: 'node_modules/**'
		}),
		minify()
	]
};
