## Balance around k

1. `p` = index of `k`. Walking left from `p`, count each balance in `cnt`, including 0 for the empty side.
2. Walking right from `p` with balance `b`: `ans += cnt[−b] + cnt[1 − b]`.
3. Return `ans`.

Examples → 3, 1. Checked against sorting every subarray on 300 random permutations.

The median is the left middle, so an even-length subarray needs one more larger value than smaller: balance 1. Values are distinct, so k appears once and every other value is strictly above or below it.

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
