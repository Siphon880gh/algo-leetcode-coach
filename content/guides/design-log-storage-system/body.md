Design `LogSystem` with `put(id, timestamp)` and `retrieve(start, end, granularity)`. Timestamps look like `"2017:01:01:23:59:59"` (Year:Month:Day:Hour:Minute:Second, zero-padded). `retrieve` returns the ids whose timestamp falls between `start` and `end` inclusive, comparing only down to the given granularity (`"Year"`, `"Month"`, …, `"Second"`). With logs at `2017:01:01:23:59:59`, `2017:01:01:22:59:59` and `2016:01:01:00:00:00`, `retrieve("2016:01:01:01:01:01", "2017:01:01:23:00:00", "Year")` → all three; with `"Hour"` → only the first two (the 2016 log is at hour 00, before the start hour 01). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Prefix length per granularity

The prefix lengths are fixed: Year 4, Month 7, Day 10, Hour 13, Minute 16, Second 19 characters.

- `put`: append `(id, timestamp)` to a list.
- `retrieve(s, e, g)`: let `k = length[g]`. Return every id with `s[:k] ≤ ts[:k] ≤ e[:k]`.

Zero-padding makes string order the same as time order, so no parsing is needed. With many logs, keeping them sorted by timestamp lets you binary search the range instead of scanning.

Do not compare the full strings; at `"Day"` granularity, a log later on the end day must still count. Do not parse into integers field by field; the prefix comparison already does that.

Time: O(1) for `put`, O(n) for `retrieve`  
Space: O(n)

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
