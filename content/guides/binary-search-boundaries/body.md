## Tiny example

The sorted array is `a = [1, 2, 2, 2, 5]`. Ask the yes-or-no question "is `a[i] >= 2`?".

- The **first index where the answer is yes** is `1`.
- For the question "is `a[i] <= 2`?", the **last index where the answer is yes** is `3`.

To land on the edge, the loop has to choose `mid` and move `lo` or `hi` carefully, so it never skips past the first or last match.

## How

1. Write a yes-or-no test `ok(i)` that is false for a while and then true for the rest.
2. While more than one candidate is left, test `mid`.
3. To find the first true index: if `ok(mid)` is true, set `hi = mid`. Otherwise set `lo = mid + 1`.
4. When the loop ends, check the answer at `lo`.

## Trap

Using a plain "find any match" binary search when the problem asks for the first or last position.

**Fix:** Write the boundary version on purpose. It helps to draw the answers as a strip like `F F T T T` and look for the first `T`.

**Time:** O(log n) · **Space:** O(1)

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
