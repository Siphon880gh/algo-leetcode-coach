## The smallest |x| has only one possible partner

`count = Counter(arr)`. For each key `x` sorted by `|x|`:

- If `count[x] == 0`, skip.
- If `x == 0`: if `count[0]` is odd, return false; continue.
- If `count[2x] < count[x]`, return false.
- `count[2x] −= count[x]`.

Return true.

With the smallest `|x|`, `x / 2` has already been handled, so `x` must pair with `2x`. Sorting by absolute value makes this work for negatives too (−2 pairs with −4).

Do not sort by value; −4 would come before −2, but its partner is −2 (its half), not −8. Do not forget the zero case.

Time: O(n log n)  
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
