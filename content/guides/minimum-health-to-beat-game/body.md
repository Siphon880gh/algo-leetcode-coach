You play levels in order and level i costs damage[i] health. Once in the whole game you may use armor on one level, reducing that level’s damage by up to armor. Your health must stay greater than 0 at all times. Return the minimum starting health needed to finish. For instance, [2,7,4,3] with armor 4 → 13; [2,5,3,4] with armor 7 → 10; [3,3,3] with armor 0 → 10. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One formula

Return `Σ damage − min(max(damage), armor) + 1`.

Constructed checks (verified against trying every level for the armor and every starting health on 200 random cases): the three cases above → 13, 10, 10.

Health only matters at the end because it never rises, so the total taken decides everything. Sums reach 10^10, so use 64-bit.

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
