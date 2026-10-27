## Example first

meetings = [[3, 5, 4], [4, 7, 8], [8, 10, 3]].

1. Take [4, 7, 8] and [8, 10, 3]. Revenue 8 + 3 = 11.
2. The idle gap from 7 to 8 pays 1 more.
3. Total 12. Adding [3, 5, 4] is impossible because it overlaps [4, 7].

## Idea

Idle pay is next start − previous end. If a schedule ends with meeting (s, e, v), extending an earlier schedule that ended at e' ≤ s adds v + s − e'. So for each meeting we want the best (earlier value − earlier end), and that is a prefix maximum once meetings are sorted by end.

## Steps

1. Sort meetings by end.
2. For meeting i = (s, e, v), binary-search j = how many earlier meetings end at or before s.
3. val = v (start fresh), or v + s + preMax[j] when j > 0.
4. preMax[i + 1] = max(preMax[i], val − e).
5. Answer = the largest val.

## Trap

Ignoring idle pay and running plain weighted interval scheduling. Example 1 then gives 7 instead of 8. Fix: add start minus the previous end.

Checked: the examples give 8, 12 and 11, and the DP matched trying every non-overlapping subset on 300 random inputs.

Time: O(n log n)  
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
