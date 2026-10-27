## Tiny example

Sort the keys `[170, 45, 75, 90, 802, 24, 2, 66]` with LSD (least significant digit) radix sort in base 10.

1. Stable-sort by the **ones** digit.
2. Stable-sort by the **tens** digit.
3. Stable-sort by the **hundreds** digit.

After the last digit pass, the list is fully sorted. Each pass is a stable counting sort on the digits `0…9`.

## How

1. Choose a base `b`, often 10 or 256.
2. Go through the digit positions from least significant to most significant.
3. For each position, do a stable counting sort by that digit.

## Trap

Using an **unstable** partition for a digit pass. Later passes cannot undo the disorder it causes.

**Fix:** Every digit pass must be stable, for example a counting sort into an output buffer.

**Time:** O(d · (n + b)) for d digits · **Space:** O(n + b)

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
