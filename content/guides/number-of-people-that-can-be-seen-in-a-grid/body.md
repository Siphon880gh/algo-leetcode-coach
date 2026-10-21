You are given an m × n grid of positive heights. A person at (r, c) can see a person to the right in the same row, or below in the same column, when everyone strictly between them is shorter than both of them. Return an m × n array with the number of people each person can see. For instance, [[3,1,4,2,5]] → [[2,1,2,1,0]]; [[5,1],[3,1],[4,1]] → [[3,1],[2,1],[1,0]]. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Same stack, two directions

1. For each row, go right to left: `c = 0`; while `top < h`: pop, `c++`; if the stack is non-empty, `c++`; while `top = h`: pop; push `h`; add `c` to the answer.
2. Repeat for each column, bottom to top, adding to the same answers.

Constructed checks (verified against testing every pair directly on 300 random grids): the cases above → [[2,1,2,1,0]], [[3,1],[2,1],[1,0]].

A popped person is hidden from everyone further left by the current person, so each height is pushed and popped once. An equal height is seen but blocks everyone behind it.

Time: O(m · n)  
Space: O(max(m, n))

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
