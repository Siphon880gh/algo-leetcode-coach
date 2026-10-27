## Predecessor sums

Rules: a → e; e → a, i; i → anything but i; o → i, u; u → a.

Reversed (what can precede each letter):
- new `a` = `e + i + u`
- new `e` = `a + i`
- new `i` = `e + o`
- new `o` = `i`
- new `u` = `i + o`

Start with all five at 1 (length 1), apply the update `n − 1` times, and return the sum mod `10⁹ + 7`.

`n = 1` → 5, `n = 2` → 10, `n = 5` → 68.

Do not mix up the direction; the update needs predecessors, not successors. Do not update the counters one at a time in place; use the old values for all five.

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
