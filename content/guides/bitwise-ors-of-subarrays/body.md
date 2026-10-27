## At most 30 distinct values per end

Let `cur` be the set of ORs of subarrays ending at `i − 1`. Then the ORs ending at `i` are `{x | a[i] for x in cur} ∪ {a[i]}`.

1. `all = {}`, `cur = {}`.
2. For each `a`: `cur = {x | a for x in cur} ∪ {a}`; add `cur` to `all`.
3. Return `len(all)`.

Why `cur` is small: extending a subarray to the left can only add bits, so the ORs ending at `i` form an increasing chain of supersets, and a 30-bit number can grow at most 30 times.

Do not enumerate all O(n²) subarrays. Do not reset `all` each step; it collects every distinct result.

Time: O(n · 30)  
Space: O(n · 30) for the result set in the worst case

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
