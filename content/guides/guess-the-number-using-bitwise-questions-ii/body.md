A hidden integer is fixed. You can ask questions through an API: you pass a number, it answers how many bit positions agree between the hidden number and yours, and each question may also change the hidden number in the way the statement describes. Recover the original hidden number. The API name, the bit width, the call limit and the exact effect of a question are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Compare with a baseline

This assumes the answer counts agreeing bits over a fixed width and that asking with num replaces the hidden number by its XOR with num after answering; check the official statement.

1. base = ask(0) (XOR with 0 changes nothing).
2. For each bit i: c = ask(2^i). If c > base, bit i is 1 (it now agrees); otherwise it is 0. Ask 2^i again to undo the flip.
3. Return the collected bits.

Constructed check (run in code with a simulated API, 30-bit width): 2,000 random hidden numbers recovered, with the hidden number back to its start; 61 questions each.

Do not compare c with 1 on its own: the other bits’ agreements are in c too, which is why the baseline is needed.

Time: O(width) questions  
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
