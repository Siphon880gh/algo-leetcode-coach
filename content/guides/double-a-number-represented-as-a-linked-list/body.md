## Look ahead

1. If `head.val ≥ 5`, put a new node 0 in front.
2. For each node: `val = (2 · val) mod 10`, plus 1 if `next.val ≥ 5`.
3. Return the head.

Examples → [3, 7, 8], [1, 9, 9, 8]. Checked against integer doubling on 400 random numbers.

Doubling a digit gives at most 18, plus a carry of 1, so each carry is 0 or 1 and depends only on the next digit. The list can have 10^4 digits, too big for 64-bit; process it digit by digit.

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
