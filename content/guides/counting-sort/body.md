## Tiny example

Sort keys `[2, 0, 2, 1, 0]` known to lie in `0 … 2`.

1. Count frequencies: `count = [2, 1, 2]` for keys 0,1,2
2. Prefix sums → ending positions: `prefix = [2, 3, 5]`
3. Place each key into an output array using the prefix (stable: scan input right→left)

Output: `[0, 0, 1, 2, 2]`

## When it works

Keys must be integers in a small range `0 … k` (or easily mapped). If `k` is huge (e.g. arbitrary 64-bit ids), counting blows up.

## Trap

Using counting sort on unrestricted strings/ids without a bounded alphabet — memory explodes.

**Fix:** Require small `k`. Time/space **O(n + k)**.

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
