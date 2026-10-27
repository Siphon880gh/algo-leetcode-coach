## Tiny example

Sort the keys `[2, 0, 2, 1, 0]`. Every key is between 0 and 2.

1. Count how often each key appears: `count = [2, 1, 2]` for the keys 0, 1 and 2.
2. Turn the counts into running totals: `prefix = [2, 3, 5]`. `prefix[v]` tells you where the last copy of key `v` ends in the output.
3. Scan the input from right to left. Put each key at position `prefix[key] − 1`, then subtract 1 from `prefix[key]`. Scanning right to left keeps equal keys in their original order, which makes the sort stable.

Output: `[0, 0, 1, 2, 2]`

## When it works

The keys must be integers in a small range from 0 to k, or easy to map into one. If k is huge, such as arbitrary 64-bit ids, the count array becomes far too big.

## Trap

Using counting sort on strings or ids with no small bound on the values. The memory needed explodes.

**Fix:** Only use it when k is small. Time and space are both **O(n + k)**.

**Time:** O(n + k)  
**Space:** O(n + k)

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
