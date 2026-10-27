## Diagonal fixes the square

- `add(p)`: `cnt[p] += 1`.
- `count(x, y)`: for each stored `(a, b)` with `a != x` and `|a − x| == |b − y|`: `ans += cnt[(a, b)] · cnt[(a, y)] · cnt[(x, b)]`.

Example 1 → `1, 0, 2`.

Duplicates multiply because they are different points. `a != x` excludes zero-area squares. Iterating points grouped by `x == query x` (then picking the side length) is an equivalent variant that is faster when few points share the column.

Time: add O(1); count O(P) distinct points  
Space: O(P)

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
