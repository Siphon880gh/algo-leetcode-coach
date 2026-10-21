## Exactly one swap

1. If the lengths differ, return false.
2. If `s == goal`: return true if any letter appears twice (swap the two copies), else false.
3. Otherwise collect the indices where `s[i] != goal[i]`. Return true only if there are exactly two, `i` and `j`, with `s[i] == goal[j]` and `s[j] == goal[i]`.

The swap is mandatory, which is why `"ab"` and `"ab"` give false.

Do not return true for equal strings without checking for a repeat. Do not accept one mismatch, or three or more.

Time: O(n)  
Space: O(1) (26 letter counts)

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
