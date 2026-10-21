## Small AND sets

1. `cur = {x & v for v in cur} ∪ {x}` for each `x`.
2. `best = min(best, |v − target|)` for `v` in `cur`.

`[9,12,3,7,15]`, 5 → 2. `[1000000,1000000,1000000]`, 1 → 999999. `[1,2,4,8,16]`, 0 → 0.

Do not try all O(n²) subarrays. The set stays small because each distinct value has strictly fewer bits than the previous one.

Time: O(n · log max)  
Space: O(log max)

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
