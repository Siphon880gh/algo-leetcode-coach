## Requirement per row

1. `z[r]` = trailing zeros of row r.
2. For `i` in 0..n−1: find the smallest `j ≥ i` with `z[j] ≥ n − 1 − i`; if none, return −1.
3. `ans += j − i`; move `z[j]` to position i (shifting the others down).

`[[0,0,1],[1,1,0],[1,0,0]]` → 3. Four rows `[0,1,1,0]` → −1. `[[1,0,0],[1,1,0],[1,1,1]]` → 0.

Do not pick the row with the most zeros; taking the nearest qualifying row keeps stronger rows for later at lower cost.

Time: O(n²)  
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
