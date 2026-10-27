## Example first

s = "1502".

1. No reversal: 0 to 1 (1), 1 to 5 (4), 5 to 0 (5), 0 to 2 (2). Total 12.
2. Reverse the suffix from k = 1: "1205". 0 to 1 (1), 1 to 2 (1), 2 to 0 (2), 0 to 5 (5). Total 9.

Answer 9.

## Idea

Dial distance is symmetric, and a reversed suffix has the same neighbour pairs, just read backwards. Its inner cost does not change. Only two things can change:

1. The edge where the prefix meets the suffix: (s[k − 1], s[k]) becomes (s[k − 1], s[n − 1]).
2. For k = 0, the first digit dialed becomes s[n − 1].

## Steps

1. total = sum of dist(s[i], s[i + 1]).
2. No reversal: dist(0, s[0]) + total.
3. k = 0: dist(0, s[n − 1]) + total.
4. k ≥ 1: dist(0, s[0]) + total − dist(s[k − 1], s[k]) + dist(s[k − 1], s[n − 1]).
5. Return the minimum.

## Trap

Trying only "no reversal" or "reverse everything". Example 1 needs k = 1, and that shortcut gives 12 instead of 9. Fix: try every k.

Checked: the examples give 9, 12 and 6, and the formula matched dialing every reversed string on 300 random strings.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
