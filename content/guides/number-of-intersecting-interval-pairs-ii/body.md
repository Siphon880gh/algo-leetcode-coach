## Example first

intervals = [[1, 5], [2, 4], [3, 6]].

1. Starts sorted: 1, 2, 3. Ends sorted: 4, 5, 6.
2. No end is below 1, 2 or 3, so nothing is disjoint.
3. Answer 3 · 2 / 2 − 0 = 3.

## Steps

1. total = n(n − 1) / 2 in a 64-bit integer.
2. Sort the starts and the ends separately.
3. For each start s, advance a pointer over the ends while end < s, and subtract the pointer position.
4. Return what is left.

Checking every pair is about 5 × 10^9 checks here, so the sweep is required.

## Trap

Storing the count in 32 bits. With n = 10^5 the total is about 5 × 10^9, which overflows. Fix: use 64-bit integers.

Checked: the examples give 2, 3 and 0, and the sweep matched checking every pair on 300 random inputs.

Time: O(n log n)  
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
