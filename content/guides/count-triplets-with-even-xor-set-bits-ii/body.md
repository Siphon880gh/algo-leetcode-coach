Given three integer arrays a, b and c, count the triplets (i, j, k) for which a[i] XOR b[j] XOR c[k] has an even number of set bits. This version has larger limits than part I; they are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Parities only

1. For each array, count values with an even and an odd number of set bits.
2. Add e_a e_b e_c + e_a o_b o_c + o_a e_b o_c + o_a o_b e_c.

Constructed checks (run in code): [1], [2], [3] → 1; [1, 1], [2, 3], [1, 5] → 4. Checked against every triplet on 300 random cases.

Testing every triplet is cubic in the lengths; counting parities is linear.

Time: O(total length · log max)  
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
