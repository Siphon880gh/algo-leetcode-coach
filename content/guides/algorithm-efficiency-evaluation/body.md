## Tiny example

Same algorithm idea in two environments:

- Big-O says both are O(n)
- Benchmark: language A finishes 10ms; language B 80ms on the same n — constants, allocator, cache

Use asymptotics to **rule out** bad growth; use timers/profilers to compare constants.


## How

1. Derive Big-O for scaling arguments
2. Measure wall time / ops for fixed realistic n
3. Watch cache locality and hidden library costs


## Trap

Picking an O(n log n) algorithm over an O(n²) one for n=20 without measuring — the quadratic may win on tiny n.

**Fix:** Asymptotics matter as n grows; for tiny n, constants dominate.

**Tools:** Big-O + benchmarks + profilers

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
