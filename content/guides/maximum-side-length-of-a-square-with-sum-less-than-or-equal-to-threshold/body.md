## O(1) square sums

1. `P[i + 1][j + 1] = mat[i][j] + P[i][j + 1] + P[i + 1][j] − P[i][j]`.
2. Square of side `k` with top-left `(i, j)`: `P[i + k][j + k] − P[i][j + k] − P[i + k][j] + P[i][j]`.
3. Binary search the largest `k` for which some square has sum `≤ threshold`; values are non-negative, so feasibility only drops as `k` grows.

First example, threshold 4 → 2. All-2 grid, threshold 1 → 0.

Do not sum each square cell by cell; that is O(k²) per square. Do not stop at the first fitting square; you want the largest side.

Time: O(m · n · log min(m, n))  
Space: O(m · n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
