## Tiny example

Sorted array `a = [1, 2, 2, 2, 5]`. Predicate “`a[i] >= 2`”.

- **Leftmost True** (first index where pred holds) → index `1`
- **Rightmost True** for “`a[i] <= 2`” → index `3`

The loop must bias `mid` and update `lo`/`hi` so you do not skip the edge occurrence.


## How

1. Write a monotonic predicate `ok(i)`
2. While the search range has more than one candidate, test `mid`
3. For first-True: if `ok(mid)` move `hi = mid`; else `lo = mid+1`
4. Verify `lo` at the end


## Trap

Using plain “find any equal” binary search when the problem asks for first/last position.

**Fix:** Code the boundary template explicitly; draw the boolean strip `F F T T T`.

**Time:** O(log n) · **Space:** O(1)

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
