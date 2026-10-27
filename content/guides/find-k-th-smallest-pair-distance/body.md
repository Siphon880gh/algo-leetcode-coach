## Count pairs within d

After sorting, for each `right`, move `left` forward while `nums[right] − nums[left] > d`. Then the `right − left` pairs ending at `right` all have distance `≤ d`. Summing gives `count(d)` in O(n), because `left` only moves forward.

Binary search `d` in `[0, max − min]`: if `count(mid) ≥ k`, set `hi = mid`, else `lo = mid + 1`. The final `lo` is an actual pair distance, because the count only increases at real distances.

Do not generate all pairs and use a heap; that is O(n²) memory with `n = 10⁴`. Do not count pairs by binary searching inside each step unless needed; the two-pointer count is simpler and linear.

Time: O(n log n + n log W), for W = max − min  
Space: O(1) beyond sorting

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
