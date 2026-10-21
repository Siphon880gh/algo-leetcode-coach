## Closed form

1. Allow shared endpoints by stretching: the 2k endpoints chosen from `n + k − 1` slots.
2. Answer `C(n + k − 1, 2k)` mod 1e9+7 (compute with factorials and inverses, or Python `comb`).

`n = 4, k = 2` → C(5, 4) = 5. `n = 3, k = 1` → C(3, 2) = 3. `n = 30, k = 7` → 796297179.

DP alternative: `f[i][j][open]` with prefix sums, O(n · k). Do not forget segments must have positive length.

Time: O(n + k)  
Space: O(n + k)

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
