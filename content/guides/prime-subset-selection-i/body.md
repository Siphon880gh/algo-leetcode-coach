## Example first

n = 15, s = 15. Primes: 2, 3, 5, 7, 11, 13.

1. 2 + 3 + 5 = 10 fits.
2. Adding 7 makes 17 > 15.
3. So at most 3 primes fit. [2, 3, 5] is one answer; [3, 5, 7] is another.

## Idea

For any fixed count c, the smallest possible sum comes from the c smallest primes. So the largest count is the longest prefix of the sorted primes whose sum stays within s.

## Steps

1. Sieve the primes up to n.
2. Take them in increasing order while the next prime fits the remaining budget.
3. The first prime that does not fit ends the scan: every later prime is larger.

## Trap

Treating 1 as a prime. n = 5, s = 1 then returns [1] instead of []. Fix: the smallest prime is 2.

Checked: the examples match (any 3 primes within budget are accepted for Example 2), and the count matched trying every subset on 300 random cases.

Time: O(n log log n)  
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
