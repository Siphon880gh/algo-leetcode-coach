## Contribution of each element

For each `i`:

- `left[i]` = `i − p`, where `p` is the index of the previous element **strictly smaller** than `arr[i]` (or −1).
- `right[i]` = `q − i`, where `q` is the index of the next element **smaller or equal** (or `n`).

`arr[i]` is the minimum of exactly `left[i] · right[i]` subarrays. The answer is `Σ arr[i] · left[i] · right[i]` mod 10⁹ + 7.

Compute both with an increasing stack in one or two passes: when `arr[i]` pops an index `j`, `i` is `j`'s next smaller-or-equal, and the index under `j` is its previous smaller.

The strict/non-strict split breaks ties: with equal values, the subarray is credited to exactly one of them.

Do not enumerate subarrays; that is O(n²). Do not use strict on both sides; equal minimums would be counted twice.

Time: O(n)  
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
