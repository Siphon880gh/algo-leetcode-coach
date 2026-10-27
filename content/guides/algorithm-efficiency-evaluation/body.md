## Tiny example

Run the same algorithm in two environments:

- Big-O says both versions are O(n).
- A benchmark on the same n shows language A finishing in 10 ms and language B in 80 ms. The gap comes from constants: the allocator, the cache, and the runtime.

Use Big-O to **rule out** algorithms that grow too fast. Use timers and profilers to compare constant factors.

## How

1. Work out the Big-O to argue about how the cost scales.
2. Measure wall-clock time, or count operations, for a fixed and realistic n.
3. Watch for cache effects and hidden costs inside library calls.

## Trap

Choosing an O(n log n) algorithm over an O(n²) one when n is 20, without measuring. On tiny inputs the quadratic one may be faster.

**Fix:** Big-O matters as n grows. For tiny n, constant factors dominate.

**Tools:** Big-O analysis, benchmarks, and profilers

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
