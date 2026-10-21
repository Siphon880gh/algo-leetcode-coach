## Track first, last, gap

1. Walk nodes with index `i`, `prev`, `cur`, `cur.next`.
2. A node is critical if `cur > prev and cur > next` or `cur < prev and cur < next`.
3. On a critical `i`: `minGap = min(minGap, i − last)` when `last` exists; `first` stays the first one; `last = i`.
4. Fewer than two → `[-1, -1]`; else `[minGap, last − first]`.

Examples → `[-1,-1]`, `[1,3]`, `[3,3]`.

The minimum distance is always between consecutive critical points, and the maximum between the first and last. Equal neighbours are not critical (strict comparisons).

Time: O(n)  
Space: O(1)

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
