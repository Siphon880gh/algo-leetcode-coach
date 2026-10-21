## Integer cents

1. For each word `w`: it is a price if `len(w) > 1`, `w[0] = $` and the rest are all digits.
2. `c = int(w[1:]) · (100 − discount)` is the new price in cents; write `$` + `c / 100` + `.` + `c mod 100` padded to two digits.
3. Join with single spaces.

Examples → there are $0.50 $1.00 and 5$ candies in the shop; 1 2 $0.00 4 $0.00 $0.00 7 8$ $0.00 $10$.

$, 5$ and $10$ are not prices: the dollar sign must be first and followed only by digits. Prices have up to 10 digits, so `c` stays below 10^12 and fits in 64-bit, and integer cents avoid floating-point rounding entirely.

Time: O(n)  
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
