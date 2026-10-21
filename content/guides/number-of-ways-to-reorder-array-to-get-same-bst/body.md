## Combine subtree orders

1. `f(a)`: if `len(a) ≤ 2`, return 1.
2. `left = [x < a[0]]`, `right = [x > a[0]]` (keeping order).
3. `f = C(len − 1, len(left)) · f(left) · f(right)` mod 1e9+7.
4. Return `f(nums) − 1`.

`[2,1,3]` → 1. `[3,4,5,1,2]` → 5. `[1,2,3]` → 0.

Do not forget to exclude the original ordering. Precompute Pascal's triangle up to 1000 for the binomials.

Time: O(n²)  
Space: O(n²)

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
