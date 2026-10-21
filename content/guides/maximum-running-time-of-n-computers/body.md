## Capped contributions

1. `lo = 0`, `hi = Σ batteries / n`.
2. `ok(T) = Σ min(b, T) ≥ n · T`.
3. Binary search the largest `T` with `ok(T)`.

Examples → 4, 2.

A battery longer than T can only power one computer at a time, so at most T of it is useful. Below that cap, free swapping lets the minutes be packed into n parallel timelines. Sums reach about 10^14, so use 64-bit.

Time: O(m log(sum / n))  
Space: O(1)

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
