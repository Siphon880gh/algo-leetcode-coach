You get a string that is either an integer literal, possibly negative, or a call op(a,b) where op is add, sub, mul or div and a and b are valid expressions themselves. Return its integer value. Assumed here: every division comes out exact and every intermediate value fits in a 64-bit integer. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## parse(i)

1. If s[i] is a digit or '-', read the integer and return it with the next index.
2. Else read op up to '('; a = parse(after '('); b = parse(after ','); skip ')'.
3. Return add, sub, mul or div of a and b (division is exact under this restatement).

Constructed checks (made-up values, run in code): "sub(9,5)" → 4; "mul(add(2,-3),7)" → −7; "div(sub(20,2),mul(3,3))" → 2; "15" → 15. Checked against Python evaluation on 2,000 random expressions.

Popping operands in stack order and computing b − a for sub: "sub(9,5)" → −4 instead of 4.

Time: O(n)  
Space: O(depth)

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
