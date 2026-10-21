## Largest first, early exit

1. Row prefix sums and column prefix sums.
2. For `k = min(m, n) … 2`, for each top-left `(i, j)`: target = first row's sum; check the other rows, every column, and both diagonals.
3. First success returns `k`; otherwise return 1.

Example 1 → 3 (all lines sum to 12). Example 2 → 2.

Every 1 × 1 grid is magic, so the answer is at least 1. Stop checking a window at the first mismatch; most windows fail quickly.

Time: O(m · n · min(m, n)²)  
Space: O(m · n)

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
