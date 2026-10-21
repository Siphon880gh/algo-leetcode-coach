## Index arithmetic

1. If `k > 3 · 2^(n − 1)`, return `""`.
2. `k −= 1`. For each position `i`: options are `a, b, c` minus the previous letter; block size `2^(n − 1 − i)`; pick `options[k / block]`, `k %= block`.

`n = 1, k = 3` → `"c"`. `n = 1, k = 4` → `""`. `n = 3, k = 9` → `"cab"`.

Backtracking in lexicographic order and stopping at the k-th string also works within the small limits. Do not generate strings with equal neighbours.

Time: O(n)  
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
