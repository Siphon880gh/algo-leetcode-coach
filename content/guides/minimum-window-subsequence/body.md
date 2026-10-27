Given strings `s1` and `s2`, return the shortest contiguous substring of `s1` in which `s2` appears as a subsequence (in order, not necessarily adjacent). If several are equally short, return the leftmost; if none exists, return `""`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Forward to find an end, backward to find a start

1. From position `i`, advance through `s1` matching `s2[0], s2[1], …` until all of `s2` is matched at index `end`. If the scan runs out, stop.
2. From `end`, walk backward matching `s2` from its last letter to its first. The index where `s2[0]` matches is `start`; this is the shortest window ending at `end`.
3. Record `s1[start … end]` if it is shorter than the best (strictly shorter, so the leftmost wins ties).
4. Restart the forward scan at `start + 1`.

Each restart moves past the previous start, so the worst case is O(|s1| · |s2|).

DP alternative: `dp[i][j]` is the latest start index such that `s2[:j]` is a subsequence of `s1[start … i]`. The best window ends at any `i` where `dp[i][m]` exists.

Do not confuse this with problem 76 (Minimum Window Substring); there the letters can be in any order. Do not skip the backward pass; the forward match alone gives an end, not the tightest start.

Time: O(|s1| · |s2|)  
Space: O(1)

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
