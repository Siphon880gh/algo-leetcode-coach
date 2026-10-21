## Halve each level

1. If `n == 1`, return `"0"`.
2. `mid = 2^(n−1)`. If `k == mid`, return `"1"`.
3. If `k < mid`, recurse `(n − 1, k)`. Else return the inverse of `(n − 1, 2^n − k)`.

n = 3, k = 1 → "0". n = 4, k = 11 → "1".

Building the string (up to 2^20 − 1 characters) also passes, but the recursion needs only O(n) steps. Do not forget to invert on the right half.

Time: O(n)  
Space: O(n) recursion

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
