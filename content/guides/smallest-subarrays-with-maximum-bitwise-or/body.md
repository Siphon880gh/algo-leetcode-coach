## Nearest index per bit

1. `last[b] = −1` for bits 0 … 30.
2. For `i = n − 1 … 0`: set `last[b] = i` for every bit of `nums[i]`; `answer[i] = max(i, max(last)) − i + 1`.
3. Return `answer`.

Examples → [3,3,2,2,1], [2,1]. Checked against trying every subarray on 300 random arrays.

The largest OR from i is the OR of the whole suffix, and the subarray reaches it exactly when it includes one index for each of those bits; the nearest ones are cheapest. If `nums[i]` and everything after are 0, the answer is 1.

Time: O(31 · n)  
Space: O(31)

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
