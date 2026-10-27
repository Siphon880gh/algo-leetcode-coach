## Example first

n = 16. The terms 3, 5, 8 are consecutive and 3 + 5 = 8, so 3 + 5 + 8 = 2 · 8 = 16. True.

n = 8. 8 / 2 = 4 is not a Fibonacci number. False.

## Rule

F(i) + F(i + 1) = F(i + 2), so F(i) + F(i + 1) + F(i + 2) = 2 · F(i + 2).

## Steps

1. Put every Fibonacci number up to 10^9 in a set (about 45 of them).
2. Return true when n is even and n / 2 is in the set.

n = 2 works through 0 + 1 + 1 = 2 · 1.

## Trap

Testing whether n itself is Fibonacci. 16 then gives false instead of true, and 8 gives true instead of false. Fix: test n / 2.

Checked: the examples give true, false and true, and the rule matched summing every block of three terms for 300 random n.

Time: O(log n) to build the set  
Space: O(log n)

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
