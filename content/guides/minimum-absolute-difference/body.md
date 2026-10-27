## Adjacent gaps

1. Sort `arr`.
2. `d = min(arr[i + 1] − arr[i])`.
3. Collect `[arr[i], arr[i + 1]]` for every `i` whose gap is `d`, in order.

`[4,2,1,3]` → `[[1,2],[2,3],[3,4]]`. `[3,8,−10,23,19,−4,−14,27]` → `[[−14,−10],[19,23],[23,27]]`.

Do not compare all pairs; that is O(n²) for 10⁵ elements. Do not sort the pairs again; scanning the sorted array already produces them in ascending order.

Time: O(n log n)  
Space: O(1) extra besides the output

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
