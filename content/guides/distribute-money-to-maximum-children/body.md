## Fill, then repair

1. If `money < children`, return −1. `money −= children`.
2. `a = min(money / 7, children)`; `money −= 7a`.
3. If `a = children` and `money > 0`, `a−−` (the leftover goes to someone already at 8).
4. Else if `a = children − 1` and `money = 3`, `a−−` (the last child would get exactly 4).
5. Return `a`.

Examples → 1, 2. Checked against trying every distribution for money up to 44 and up to 4 children.

In case 4, giving the 3 dollars to someone else breaks one 8, but a 9 and another split then work, so one 8 is enough to lose.

Time: O(1)  
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
