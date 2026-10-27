## Divide prefixes

1. `p = [1]`.
2. `add(x)`: if `x == 0`, reset `p = [1]`; else append `p[−1] · x`.
3. `getProduct(k)`: if `k ≥ len(p)`, return 0; else `p[−1] / p[−1 − k]`.

Adding 3, 0, 2, 5, 4: `getProduct(2)` → 20, `(3)` → 40, `(4)` → 0; then add 8, `getProduct(2)` → 32.

Do not keep zeros in the prefix list; division by zero would follow. Do not multiply the last k values on each call; that is O(k).

Time: O(1) per call  
Space: O(n)

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
