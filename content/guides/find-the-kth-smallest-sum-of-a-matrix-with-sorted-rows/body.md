## Keep only k candidates

1. `sums = [0]`.
2. For each row: `sums = k smallest of {s + x : s in sums, x in row}`.
3. Return `sums[k − 1]`.

`[[1,3,11],[2,4,6]]`, k = 5 → 7; k = 9 → 17. `[[1,10,10],[1,4,5],[2,3,6]]`, k = 7 → 9.

Truncating to k is safe: anything beyond the k-th sum can never become one of the k smallest later. Do not enumerate all n^m combinations. A heap merge or binary search on the sum value also work.

Time: O(m · k · n · log(k·n))  
Space: O(k · n)

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
