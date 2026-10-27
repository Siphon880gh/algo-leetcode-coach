For each window of length k in an array, find the length of the shortest contiguous segment that must be sorted to make the window non-decreasing (0 if it already is), and return these lengths for the windows from left to right. This guide assumes the array is small enough for O(n · k) work. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two passes per window

1. Left to right: track the maximum; the last index with w[i] < max is r.
2. Right to left: track the minimum; the last index seen with w[i] > min is l.
3. Answer r − l + 1, or 0 if no such r.

Constructed checks (run in code): [2, 1, 4, 3, 5], k = 2 → [2, 0, 2, 0]; [4, 1, 3, 2], k = 4 → [4]. Checked against trying every segment on 300 random arrays.

Counting misplaced elements instead of the segment: window [3, 2, 1] → 2 instead of 3.

Time: O((n − k + 1) · k)  
Space: O(1) besides the output

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
