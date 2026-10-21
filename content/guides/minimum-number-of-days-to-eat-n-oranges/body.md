## Jump to divisibility

1. `f(0) = 0`, `f(1) = 1`.
2. `f(n) = 1 + min(n % 2 + f(n // 2), n % 3 + f(n // 3))`.

n = 10 → 4. n = 6 → 3. n = 2 · 10^9 → 32.

Do not run DP over 1..n (n up to 2 · 10^9). Do not BFS without pruning single steps; the formula already accounts for them.

Time: O(log² n)  
Space: O(log² n)

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
