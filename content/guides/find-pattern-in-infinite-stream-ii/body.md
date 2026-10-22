Same task as part I with larger limits: you are given a pattern of bits and read an infinite stream of bits one at a time through an interface the statement provides. Return the first index at which the pattern appears. Interface names and limits are in the official statement. For instance, a stream starting 1, 1, 1, 0, 1 with pattern [0, 1] → 3. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## KMP on a stream

This assumes the pattern does appear, so the loop ends.

1. f = KMP failure table of the pattern.
2. j = 0; for i = 0, 1, …: read bit b; while j > 0 and b ≠ p[j], j = f[j − 1]; if b = p[j], j += 1; if j = |p|, return i − |p| + 1.

Constructed checks (same code as part I, run there): the example above; [1, 1, 0, 1, 1, 0, 0, …] with [1, 1, 0, 0] → 3; 3,000 random streams match a direct search.

Comparing a window of the last |p| bits at every step costs O(|p|) per bit, which is what grows with the larger limits; KMP keeps it amortised O(1). Restarting from scratch on a mismatch misses overlaps: stream 1, 1, 1, 0 with pattern [1, 1, 0] finds nothing instead of index 1.

Time: O(answer + |p|)  
Space: O(|p|)

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
