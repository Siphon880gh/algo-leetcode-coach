## Tiny example

Sort keys `[170, 45, 75, 90, 802, 24, 2, 66]` with LSD radix (base 10).

1. Stable-sort by **ones**
2. Stable-sort by **tens**
3. Stable-sort by **hundreds**

After all digit passes, the list is fully sorted. Each pass is a stable counting sort on digits `0…9`.


## How

1. Choose base `b` (often 10 or 256)
2. For each digit position from least significant to most
3. Stable counting-sort by that digit


## Trap

Using an **unstable** partition for a digit pass — later digits cannot fix earlier disorder.

**Fix:** Each digit pass must be stable (counting sort into an output buffer).

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
