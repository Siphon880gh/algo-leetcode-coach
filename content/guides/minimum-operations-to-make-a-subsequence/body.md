## Reduce to LIS

1. `pos = {v: i for i, v in enumerate(target)}`.
2. Sequence `s = [pos[x] for x in arr if x in pos]`.
3. Patience-sort LIS of `s` (strictly increasing); return `len(target) − LIS`.

`[5,1,3]`, `[9,4,2,3,4]` → 2. `[6,4,8,1,3,2]`, `[4,7,6,2,3,8,6,1]` → 3.

Distinct target values make the mapping unique. Do not run O(n · m) LCS DP; both lengths reach 10^5.

Time: O(m log n)  
Space: O(n)

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
