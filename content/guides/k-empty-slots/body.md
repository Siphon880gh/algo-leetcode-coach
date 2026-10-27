There are `n` bulbs in a row, all off. On day `i + 1` you turn on bulb `bulbs[i]` (a permutation of `1 … n`). Given `k`, return the earliest day on which two turned-on bulbs have exactly `k` bulbs between them and all of those are still off; return `-1` if that never happens. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Think in positions

Build `days[pos]`, the day each position turns on. A valid pair is `left` and `right = left + k + 1` where every `days[i]` strictly inside is greater than both ends. That pair becomes valid on day `max(days[left], days[right])`.

Slide one window: `left = 0`, `right = k + 1`, and scan `i` from 1:

- If `i == right`: the window is valid. Record `max(days[left], days[right])`, then jump to `left = i`, `right = i + k + 1`.
- Else if `days[i] < days[left]` or `days[i] < days[right]`: this inside bulb turns on too early, so it cannot be inside. Restart with `left = i`, `right = i + k + 1`.

Stop when `right` passes the end. Return the minimum recorded day, or `-1`.

A slower O(n log n) option: turn on bulbs day by day in a sorted set and check the neighbors of each new bulb.

Do not simulate the row day by day scanning for gaps; that is O(n²).

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
