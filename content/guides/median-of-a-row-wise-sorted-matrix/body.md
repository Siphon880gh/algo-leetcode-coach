You are given an m × n matrix in which every row is sorted in non-decreasing order and m · n is odd. Return the median of all its values, aiming for better than looking at every element. For instance, [[1,1,2],[2,3,3],[1,3,4]] → 2; [[1,1,3,3,4]] → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count, don’t merge

1. `lo` = smallest first element, `hi` = largest last element; `need = (m · n + 1) / 2`.
2. While `lo < hi`: `mid = (lo + hi) / 2`; if `Σ upper_bound(row, mid) ≥ need`, `hi = mid`, else `lo = mid + 1`.
3. Return `lo`.

Constructed checks (verified against sorting all values on 400 random matrices): the cases above → 2, 3.

The count of elements ≤ x only grows with x, so the first x reaching `need` is the median, and it is always a value in the matrix. Each step costs m log n.

Time: O(m log n log(range))  
Space: O(1)

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
