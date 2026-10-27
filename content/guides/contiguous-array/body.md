## Balance as a running sum

Add `+1` for each 1 and `−1` for each 0. A subarray is balanced when its sum is 0, which means the prefix sums at its two ends are equal.

Keep `first = {0: -1}`. Walk `i` with running `s`. If `s` is in `first`, update `ans = max(ans, i − first[s])`; otherwise set `first[s] = i`. Store the first index only, so each match is as long as possible.

The prefix is in `[−n, n]`, so an array of size `2n + 1` can replace the map.

Continuous Subarray Sum (523) uses the same "first index of each prefix key" idea with remainders.

Do not overwrite `first[s]` with later indexes — that shortens the answer. Do not forget the `{0: -1}` seed, or a balanced prefix starting at index 0 is missed.

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
