A sorted array of unique integers is hidden behind an interface: `get(i)` returns the value at index `i`, or `2³¹ − 1` if `i` is past the end. Without knowing the length, return the index of `target`, or `-1` if it is not there. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Find a bound, then search

1. `lo = 0`, `hi = 1`. While `get(hi) < target`: `lo = hi`, `hi *= 2`.
2. Binary search `[lo, hi]` with `get(mid)`: equal returns `mid`, smaller moves `lo` up, larger moves `hi` down.
3. Return `-1` if the range empties.

Out-of-range indexes return `2³¹ − 1`, which is larger than any real value, so they act as `+∞`. Both the doubling and the binary search work without special cases.

Doubling reaches past the target index `p` in O(log p) steps, and the final range has length about `p`.

Do not walk forward one index at a time to find the length; that is O(n). Do not assume a fixed maximum length; the point is to search without one.

Time: O(log p), for target position p  
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
